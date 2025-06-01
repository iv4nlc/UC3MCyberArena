
from PIL import Image, ImageDraw, ImageFont

# Crear una imagen en blanco
img = Image.new("RGB", (300, 100), color=(255, 255, 255))
d = ImageDraw.Draw(img)

# Agregar la flag
flag = "XXXXXXXXXXXXXXXXXXX"
font = ImageFont.load_default()
d.text((10, 40), flag, fill=(0, 0, 0), font=font)

# Guardar como PNG
img.save("image.png")
