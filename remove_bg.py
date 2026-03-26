from PIL import Image
import sys

def remove_white_bg(image_path, output_path, tolerance=240):
    img = Image.open(image_path)
    img = img.convert("RGBA")
    
    data = img.getdata()
    
    new_data = []
    for item in data:
        # Check if the pixel is white or near white
        # item is (R, G, B, A)
        if item[0] >= tolerance and item[1] >= tolerance and item[2] >= tolerance:
            # Change near-white (also background) to transparent
            new_data.append((255, 255, 255, 0))
        else:
            new_data.append(item)
            
    img.putdata(new_data)
    img.save(output_path, "PNG")
    print(f"Background removed and saved to {output_path}")

if __name__ == "__main__":
    import os
    # get absolute path to ensure correctness
    base_dir = os.path.dirname(os.path.abspath(__file__))
    logo_path = os.path.join(base_dir, "images", "logo.png")
    remove_white_bg(logo_path, logo_path, tolerance=245)
